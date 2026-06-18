import api from "../common/api-upload";

 const ImageManagerService = {
  add: (data) => api.post("/business-access/image-manager",data)
};
export default ImageManagerService;