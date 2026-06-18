import api from "../common/api";

 const ActivityLogService = {
  list: (data) => api.get("/business-access/activity-logs",{
    params: data
  })
};
export default ActivityLogService;