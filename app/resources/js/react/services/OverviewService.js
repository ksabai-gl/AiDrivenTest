import api from "../common/api";

 const OverviewService = {
  list: () => api.get("/business-access/overviews"),
};
export default OverviewService;