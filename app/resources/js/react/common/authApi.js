import axios from "axios";

const authApi = axios.create({
  baseURL: "/api",
  timeout: 10000,
  headers: {
    "Content-Type": "application/json",
    "App-Language": localStorage.getItem("lang") || "en"
  },
});

authApi.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    const businessToken = localStorage.getItem("business-access");
    const lang = localStorage.getItem("lang") || "en";
    if (token) config.headers.Authorization = `Bearer ${token}`;
    if(businessToken) config.headers['business-access'] = businessToken;
    if(lang) config.headers['App-Language'] = lang;
    return config;
  },
  (error) => Promise.reject(error)
);

authApi.interceptors.response.use(
  (response) => response.data,
  (error) => {
    const status = error.response?.status;
    return Promise.reject(error);
  }
);

export default authApi;
