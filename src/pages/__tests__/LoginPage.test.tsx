import React from "react";
import { render, screen, waitFor } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import axios from "axios";
import { MemoryRouter } from "react-router-dom";
import LoginPage from "../LoginPage";
import * as authService from "../../services/authService";

jest.mock("../../services/authService");
const mockLogin = authService.login as jest.MockedFunction<
  typeof authService.login
>;

const mockNavigate = jest.fn();
jest.mock("react-router-dom", () => ({
  ...jest.requireActual("react-router-dom"),
  useNavigate: () => mockNavigate,
}));

function renderLoginPage() {
  return render(
    <MemoryRouter>
      <LoginPage />
    </MemoryRouter>,
  );
}

afterEach(() => {
  jest.restoreAllMocks();
  mockNavigate.mockReset();
  localStorage.clear();
});

describe("LoginPage", () => {
  describe("AC-A01 — initial render", () => {
    it("should render email field, password field, and submit button with accessible labels", () => {
      renderLoginPage();

      expect(screen.getByLabelText(/email address/i)).toBeInTheDocument();
      expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
      expect(
        screen.getByRole("button", { name: /sign in/i }),
      ).toBeInTheDocument();
    });
  });

  describe("AC-A02 — mandatory field enforcement", () => {
    it("should disable the submit button when both fields are empty", () => {
      renderLoginPage();

      expect(screen.getByRole("button", { name: /sign in/i })).toBeDisabled();
    });

    it("should disable the submit button when only email is filled", async () => {
      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );

      expect(screen.getByRole("button", { name: /sign in/i })).toBeDisabled();
    });

    it("should disable the submit button when only password is filled", async () => {
      renderLoginPage();
      await userEvent.type(screen.getByLabelText(/password/i), "secret");

      expect(screen.getByRole("button", { name: /sign in/i })).toBeDisabled();
    });

    it("should enable the submit button when both fields are filled", async () => {
      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");

      expect(screen.getByRole("button", { name: /sign in/i })).toBeEnabled();
    });
  });

  describe("AC-A03 — email format validation", () => {
    it("should show a validation error and not call the API when email format is invalid", async () => {
      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "not-an-email",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      expect(
        screen.getByText(/please enter a valid email address/i),
      ).toBeInTheDocument();
      expect(mockLogin).not.toHaveBeenCalled();
    });
  });

  describe("AC-A04 — loading state", () => {
    it("should disable the button and show loading text while the API call is in progress", async () => {
      mockLogin.mockImplementationOnce(
        () => new Promise((res) => setTimeout(() => res({ token: "tok" }), 50)),
      );

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      expect(
        screen.getByRole("button", { name: /signing in/i }),
      ).toBeDisabled();

      await waitFor(() =>
        expect(screen.getByRole("button", { name: /sign in/i })).toBeEnabled(),
      );
    });
  });

  describe("MAD-69 — fix success alert on login button", () => {
    it("AC-B02: Sign in control is type=submit inside form (no alert onClick stub)", () => {
      renderLoginPage();

      const submitButton = screen.getByRole("button", { name: /^sign in$/i });
      expect(submitButton).toHaveAttribute("type", "submit");
      expect(submitButton.closest("form")).toBeInTheDocument();
    });

    it("AC-B03: should not call window.alert on successful login", async () => {
      const alertSpy = jest
        .spyOn(window, "alert")
        .mockImplementation(() => {});
      mockLogin.mockResolvedValueOnce({ token: "jwt-abc" });

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() =>
        expect(mockNavigate).toHaveBeenCalledWith("/dashboard"),
      );
      expect(alertSpy).not.toHaveBeenCalled();
      expect(localStorage.getItem("token")).toBe("jwt-abc");
      alertSpy.mockRestore();
    });
  });

  describe("AC-C01 — successful login", () => {
    it("should store the JWT in localStorage and navigate to /dashboard on 200", async () => {
      mockLogin.mockResolvedValueOnce({ token: "jwt-abc" });

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() => {
        expect(localStorage.getItem("token")).toBe("jwt-abc");
        expect(localStorage.getItem("userEmail")).toBe("user@example.com");
        expect(mockNavigate).toHaveBeenCalledWith("/dashboard");
      });
    });
  });

  describe("AC-A03b — email blur validation", () => {
    it("should show email error on blur when email format is invalid", async () => {
      renderLoginPage();
      const emailInput = screen.getByLabelText(/email address/i);
      await userEvent.type(emailInput, "bad");
      await userEvent.tab();

      expect(
        screen.getByText(/please enter a valid email address/i),
      ).toBeInTheDocument();
      expect(mockLogin).not.toHaveBeenCalled();
    });

    it("should show email error on blur when email is empty", async () => {
      renderLoginPage();
      const emailInput = screen.getByLabelText(/email address/i);
      await userEvent.click(emailInput);
      await userEvent.tab();

      expect(screen.getByText(/email is required/i)).toBeInTheDocument();
      expect(mockLogin).not.toHaveBeenCalled();
    });
  });

  describe("AC-A03c — password validation", () => {
    it("should show password error on blur when password is empty", async () => {
      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      const passwordInput = screen.getByLabelText(/password/i);
      await userEvent.click(passwordInput);
      await userEvent.tab();

      expect(screen.getByText(/password is required/i)).toBeInTheDocument();
    });

    it("should show password error on submit when password is only whitespace", async () => {
      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "   ");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      expect(screen.getByText(/password is required/i)).toBeInTheDocument();
      expect(mockLogin).not.toHaveBeenCalled();
    });
  });

  describe("AC-C02 — invalid credentials (401)", () => {
    it('should display "Invalid email or password." and not navigate on 401', async () => {
      const error = new axios.AxiosError(
        "Unauthorized",
        undefined,
        undefined,
        undefined,
        {
          status: 401,
          data: {},
          headers: {},
          statusText: "Unauthorized",
          config: {} as never,
        },
      );
      mockLogin.mockRejectedValueOnce(error);

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "wrong");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() => {
        expect(screen.getByRole("alert")).toHaveTextContent(
          "Invalid email or password.",
        );
      });
      expect(mockNavigate).not.toHaveBeenCalled();
    });

    it("should display API message from 401 response body when provided", async () => {
      const error = new axios.AxiosError(
        "Unauthorized",
        undefined,
        undefined,
        undefined,
        {
          status: 401,
          data: { message: "Invalid email or password" },
          headers: {},
          statusText: "Unauthorized",
          config: {} as never,
        },
      );
      mockLogin.mockRejectedValueOnce(error);

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "wrong");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() => {
        expect(screen.getByRole("alert")).toHaveTextContent(
          "Invalid email or password",
        );
      });
      expect(mockNavigate).not.toHaveBeenCalled();
    });
  });

  describe("AC-C03 — server error (5xx)", () => {
    it("should display a generic error message and not navigate on 5xx", async () => {
      const error = new axios.AxiosError(
        "Server Error",
        undefined,
        undefined,
        undefined,
        {
          status: 500,
          data: {},
          headers: {},
          statusText: "Internal Server Error",
          config: {} as never,
        },
      );
      mockLogin.mockRejectedValueOnce(error);

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() => {
        expect(screen.getByRole("alert")).toHaveTextContent(
          "Something went wrong. Please try again later.",
        );
      });
      expect(mockNavigate).not.toHaveBeenCalled();
    });
  });

  describe("AC-C04 — network error", () => {
    it("should display connectivity message when request has no response", async () => {
      const error = new axios.AxiosError("Network Error");
      mockLogin.mockRejectedValueOnce(error);

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "secret");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() => {
        expect(screen.getByRole("alert")).toHaveTextContent(
          "Unable to connect. Check your network and try again.",
        );
      });
      expect(mockNavigate).not.toHaveBeenCalled();
    });
  });

  describe("AC-D01 — reset password control visible", () => {
    it("should render a Reset password button on the login form", () => {
      renderLoginPage();

      expect(
        screen.getByRole("button", { name: /reset password/i }),
      ).toBeInTheDocument();
    });
  });

  describe("AC-D02 — reset password control has no wiring", () => {
    it("should not call login API or navigate when reset password is clicked", async () => {
      renderLoginPage();

      await userEvent.click(
        screen.getByRole("button", { name: /reset password/i }),
      );

      expect(mockLogin).not.toHaveBeenCalled();
      expect(mockNavigate).not.toHaveBeenCalled();
    });
  });

  describe("AC-D03 — reset password visual consistency", () => {
    it("should render reset password as a non-submit button with link styling", () => {
      renderLoginPage();

      const resetButton = screen.getByRole("button", {
        name: /reset password/i,
      });
      expect(resetButton).toHaveAttribute("type", "button");
      expect(resetButton).toHaveClass("text-indigo-600");
      expect(resetButton.parentElement).toHaveClass("justify-between");
    });
  });

  describe("AC-D04 — reset password accessibility", () => {
    it("should expose an accessible name and be keyboard focusable", async () => {
      renderLoginPage();

      const resetButton = screen.getByRole("button", {
        name: /reset password/i,
      });
      await userEvent.tab();
      await userEvent.tab();
      await userEvent.tab();
      await userEvent.tab();

      expect(resetButton).toHaveFocus();
      expect(resetButton).toHaveClass("focus:ring-2");
    });
  });

  describe("AC-E01 — sign up control visible", () => {
    it("should render a Sign Up button on the login form", () => {
      renderLoginPage();

      expect(
        screen.getByRole("button", { name: /sign up/i }),
      ).toBeInTheDocument();
    });
  });

  describe("AC-E02 — sign up control has no wiring", () => {
    it("should not call login API or navigate when sign up is clicked", async () => {
      renderLoginPage();

      await userEvent.click(screen.getByRole("button", { name: /sign up/i }));

      expect(mockLogin).not.toHaveBeenCalled();
      expect(mockNavigate).not.toHaveBeenCalled();
    });
  });

  describe("AC-E03 — sign up visual consistency", () => {
    it("should render sign up as a non-submit button with link styling in justify-between row", () => {
      renderLoginPage();

      const signUpButton = screen.getByRole("button", { name: /sign up/i });
      expect(signUpButton).toHaveAttribute("type", "button");
      expect(signUpButton).toHaveClass("text-indigo-600");
      expect(signUpButton.parentElement).toHaveClass("justify-between");
    });
  });

  describe("AC-E04 — sign up accessibility", () => {
    it("should expose an accessible name and be keyboard focusable", async () => {
      renderLoginPage();

      const signUpButton = screen.getByRole("button", { name: /sign up/i });
      await userEvent.tab();
      await userEvent.tab();
      await userEvent.tab();

      expect(signUpButton).toHaveFocus();
      expect(signUpButton).toHaveClass("focus:ring-2");
    });
  });

  describe("error state reset", () => {
    it("should clear a previous API error when a new submission begins", async () => {
      mockLogin
        .mockRejectedValueOnce(
          new axios.AxiosError(
            "Unauthorized",
            undefined,
            undefined,
            undefined,
            {
              status: 401,
              data: {},
              headers: {},
              statusText: "Unauthorized",
              config: {} as never,
            },
          ),
        )
        .mockResolvedValueOnce({ token: "tok" });

      renderLoginPage();
      await userEvent.type(
        screen.getByLabelText(/email address/i),
        "user@example.com",
      );
      await userEvent.type(screen.getByLabelText(/password/i), "wrong");
      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));
      await waitFor(() =>
        expect(screen.getByRole("alert")).toBeInTheDocument(),
      );

      await userEvent.click(screen.getByRole("button", { name: /sign in/i }));

      await waitFor(() =>
        expect(screen.queryByRole("alert")).not.toBeInTheDocument(),
      );
    });
  });
});
