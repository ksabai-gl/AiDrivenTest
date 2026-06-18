import api from "../common/api";
import apiUpload from "../common/api-upload";
 const ExtensionService = {
  add: (data) => apiUpload.post("/business-access/extensions",data),
  update: (data) => api.put("/business-access/extensions/" + data.id,data),
  show: (id) => api.get("/business-access/extensions/" + id),
  list: (data) => api.get("/business-access/extensions",{
    params: data
  }),
  delete: (data) => api.delete("/business-access/extensions/" + data.id,{
    params: data
  }),
};
export default ExtensionService;