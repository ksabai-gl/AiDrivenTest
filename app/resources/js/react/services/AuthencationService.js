import api from "../common/api";
import authApi from "../common/authApi";

 const AuthencationService = {
  getProfile: () => api.get("/authencation/profile"),
  updateProfile: (data) => api.put("/authencation/update",data),
  login: (data) => authApi.post("/authencation", data),
  register: (data) => authApi.post("/authencation/register", data),
  verify: (data) => authApi.post("/authencation/verify", data),
  resetPassword: (data) => authApi.put("/authencation/reset-password", data),
  forgetPassword: (data) => api.put("/authencation/forget-password",data),
};
export default AuthencationService;