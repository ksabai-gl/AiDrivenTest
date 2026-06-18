import api from "../common/api";

 const NotificationService = {
  list: (data) => api.get("/business-access/notifications",{
    params: data
  }),
  listIsNotRead: () => api.get("/business-access/notifications" 
    + `?is_not_read=1`),
  listType: () => api.get("/business-access/notifications" 
    + `?get_type=1`),
  update: (data) => api.put("/business-access/notifications/" + data.id,data),
  delete: (data) => api.delete("/business-access/notifications/"  + data.id,{
    params: data
  })
};
export default NotificationService;