import api from "../common/api";

const StockMovementOut = {
    add: (data) => api.post("/business-access/stock-movement-outs", data),
    show: (id) => api.get("/business-access/stock-movement-outs/" + id),
    list: (data) => api.get("/business-access/stock-movement-outs",{
        params: data
    }),
    update: (data) => api.put("/business-access/stock-movement-outs/" + data.id, data),
};
export default StockMovementOut;