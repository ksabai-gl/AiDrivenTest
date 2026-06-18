import api from "../common/api";

 const UserService = {
  add: (data) => api.post("/business-access/users",data),
  update: (data) => api.put("/business-access/users/" + data.id,data),
  show: (id) => api.get("/business-access/users/" + id),
  list: (data) => api.get("/business-access/users",{
    params: data
  }),
  delete: (data) => api.delete("/business-access/users/" + data.id,{
    params: data
  }),
};
export default UserService;