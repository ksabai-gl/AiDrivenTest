import api from "../common/api";

const StockOutService = {
  add: (data) => api.post("/business-access/stocks/outs", data),
  show: (id) => api.get("/business-access/stocks/outs/" + id),
  list: (data) => api.get("/business-access/stocks/outs",{
    params: data
  }),
  view: () => api.get("/business-access/stocks/view/outs"),
  update: (data) => api.put("/business-access/stocks/outs/" + data.id, data),
};
export default StockOutService;