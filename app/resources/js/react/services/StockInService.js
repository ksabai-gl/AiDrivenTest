import api from "../common/api";

 const StockInService = {
  add: (data) => api.post("/business-access/stocks/ins",data),
  show: (id) => api.get("/business-access/stocks/ins/" + id),
  list: (data) => api.get("/business-access/stocks/ins",{
    params: data
  }),
  view: () => api.get("/business-access/stocks/view/ins"),
  update: (data) => api.put("/business-access/stocks/ins/" + data.id,data),
};
export default StockInService;