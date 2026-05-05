import axios from "axios";
import { render, screen, waitFor } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import { MemoryRouter, Route, Routes } from "react-router-dom";
import { beforeEach, describe, expect, it, type Mock, vi } from "vitest";
import Login from "../Login";

vi.mock("axios");

const mockedPost = axios.post as unknown as Mock;

const renderLogin = () => {
  return render(
    <MemoryRouter initialEntries={["/login"]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<div>Dashboard</div>} />
      </Routes>
    </MemoryRouter>
  );
};

describe("Login page", () => {
  beforeEach(() => {
    mockedPost.mockReset();
    localStorage.clear();
    vi.stubEnv("REACT_APP_API_BASE_URL", "http://localhost:3000");
  });

  it("disables login button when required fields are empty", () => {
    renderLogin();
    expect(screen.getByRole("button", { name: /login/i })).toBeDisabled();
  });

  it("shows email validation error on blur", async () => {
    renderLogin();
    const user = userEvent.setup();
    await user.type(screen.getByLabelText(/email/i), "invalid-email");
    await user.tab();

    expect(screen.getByText(/please enter a valid email address/i)).toBeInTheDocument();
    expect(screen.getByRole("button", { name: /login/i })).toBeDisabled();
  });

  it("stores token and navigates on successful login", async () => {
    mockedPost.mockResolvedValueOnce({ data: { token: "jwt-token" } });

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/email/i), "test@example.com");
    await user.type(screen.getByLabelText(/password/i), "secret");
    await user.click(screen.getByRole("button", { name: /login/i }));

    await waitFor(() => {
      expect(localStorage.getItem("token")).toBe("jwt-token");
    });

    expect(screen.getByText("Dashboard")).toBeInTheDocument();
  });

  it("shows 401 inline message", async () => {
    mockedPost.mockRejectedValueOnce({
      response: { status: 401 }
    });

    renderLogin();
    const user = userEvent.setup();

    await user.type(screen.getByLabelText(/email/i), "test@example.com");
    await user.type(screen.getByLabelText(/password/i), "wrong");
    await user.click(screen.getByRole("button", { name: /login/i }));

    expect(await screen.findByRole("alert")).toHaveTextContent("Invalid email or password");
  });
});
