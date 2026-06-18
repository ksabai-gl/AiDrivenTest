import api from "../common/api";

const StockMovementInService = {
    add: (data) => api.post("/business-access/stock-movement-ins", data),
    show: (id) => api.get("/business-access/stock-movement-ins/" + id),
    list: (data) => api.get("/business-access/stock-movement-ins",{
        params: data
    }),
    update: (data) => api.put("/business-access/stock-movement-ins/" + data.id, data),
};
export default StockMovementInService;