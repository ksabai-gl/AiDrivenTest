import { fireEvent, render, screen, waitFor } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import { MemoryRouter, Route, Routes } from "react-router-dom";
import axios from "axios";
import { afterEach, beforeEach, describe, expect, it, vi } from "vitest";
import { LoginPage } from "../Login";
import { AUTH_TOKEN_STORAGE_KEY } from "../../auth/storage";

vi.mock("axios", async (importOriginal) => {
  const mod = await importOriginal<typeof import("axios")>();
  return {
    ...mod,
    default: {
      ...mod.default,
      post: vi.fn(),
    },
  };
});

const mockedAxiosPost = vi.mocked(axios.post);

function renderLogin() {
  render(
    <MemoryRouter initialEntries={["/login"]}>
      <Routes>
        <Route path="/login" element={<LoginPage />} />
        <Route path="/dashboard" element={<div>Dashboard route</div>} />
      </Routes>
    </MemoryRouter>,
  );
}

describe("LoginPage", () => {
  beforeEach(() => {
    vi.stubEnv("REACT_APP_API_BASE_URL", "http://localhost:3001");
    mockedAxiosPost.mockReset();
  });

  afterEach(() => {
    vi.unstubAllEnvs();
    localStorage.clear();
  });

  it("AC-01: shows validation feedback for empty fields and invalid email", async () => {
    renderLogin();

    const user = userEvent.setup();
    const email = screen.getByLabelText(/^email$/i);
    const password = screen.getByLabelText(/^password$/i);

    await user.click(email);
    await user.tab();
    expect(await screen.findByText(/email is required/i)).toBeInTheDocument();

    await user.click(password);
    await user.tab();
    expect(await screen.findByText(/password is required/i)).toBeInTheDocument();

    await user.type(email, "not-an-email");
    await user.tab();

    expect(
      await screen.findByText(/enter a valid email address/i),
    ).toBeInTheDocument();

    expect(mockedAxiosPost).not.toHaveBeenCalled();
  });

  it("AC-02: disables submit until fields are filled; shows spinner while loading", async () => {
    renderLogin();

    const btn = screen.getByRole("button", { name: /^sign in$/i });
    expect(btn).toBeDisabled();

    const user = userEvent.setup();

    mockedAxiosPost.mockImplementationOnce(
      () =>
        new Promise(() => {
          /* never resolves in this assertion window */
        }),
    );

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");

    await waitFor(() => expect(btn).not.toBeDisabled());
    await user.click(btn);

    expect(btn).toBeDisabled();
    expect(screen.getByText(/signing in/i)).toBeInTheDocument();
  });

  it("AC-03: stores JWT and navigates after 200 OK", async () => {
    mockedAxiosPost.mockResolvedValueOnce({ data: { token: "jwt-123" } });

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    await waitFor(() =>
      expect(localStorage.getItem(AUTH_TOKEN_STORAGE_KEY)).toBe("jwt-123"),
    );
    expect(await screen.findByText(/dashboard route/i)).toBeInTheDocument();

    expect(mockedAxiosPost).toHaveBeenCalledWith(
      "http://localhost:3001/auth/login",
      { email: "human@example.com", password: "secret123" },
      expect.objectContaining({ headers: { "Content-Type": "application/json" } }),
    );
  });

  it("AC-04: maps 401 to invalid credentials message", async () => {
    mockedAxiosPost.mockRejectedValueOnce(
      Object.assign(new Error("Unauthorized"), {
        isAxiosError: true,
        response: { status: 401, data: { message: "nope" } },
      }),
    );

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "bad");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    expect(
      await screen.findByText(/invalid email or password/i),
    ).toBeInTheDocument();

    expect(screen.queryByRole("button", { name: /signing in/i })).not.toBeInTheDocument();
  });

  it("AC-04: maps 5xx errors to generic message", async () => {
    mockedAxiosPost.mockRejectedValueOnce(
      Object.assign(new Error("Server Error"), {
        isAxiosError: true,
        response: { status: 500 },
      }),
    );

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    expect(
      await screen.findByText(/something went wrong/i),
    ).toBeInTheDocument();
  });

  it("shows generic error when success body has no usable token", async () => {
    mockedAxiosPost.mockResolvedValueOnce({ data: { token: "" } });

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    expect(
      await screen.findByText(/something went wrong/i),
    ).toBeInTheDocument();
    expect(localStorage.getItem(AUTH_TOKEN_STORAGE_KEY)).toBeNull();
  });

  it("maps non-Axios failures to generic message", async () => {
    mockedAxiosPost.mockRejectedValueOnce(new Error("network down"));

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    expect(
      await screen.findByText(/something went wrong/i),
    ).toBeInTheDocument();
  });

  it("maps other client Axios errors to generic message", async () => {
    mockedAxiosPost.mockRejectedValueOnce(
      Object.assign(new Error("Forbidden"), {
        isAxiosError: true,
        response: { status: 403 },
      }),
    );

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");
    await user.click(screen.getByRole("button", { name: /^sign in$/i }));

    expect(
      await screen.findByText(/something went wrong/i),
    ).toBeInTheDocument();
  });

  it("shows API URL error when env is missing and form is submitted programmatically", async () => {
    vi.stubEnv("REACT_APP_API_BASE_URL", "");
    mockedAxiosPost.mockReset();

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/^email$/i), "human@example.com");
    await user.type(screen.getByLabelText(/^password$/i), "secret123");

    const submitButton = screen.getByRole("button", { name: /^sign in$/i });
    expect(submitButton).toBeDisabled();

    const form = submitButton.closest("form");
    expect(form).toBeInstanceOf(HTMLFormElement);
    fireEvent.submit(form as HTMLFormElement);

    expect(
      await screen.findByText(/api base url is not configured/i),
    ).toBeInTheDocument();
    expect(mockedAxiosPost).not.toHaveBeenCalled();
  });
});
