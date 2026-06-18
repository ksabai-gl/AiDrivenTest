import api from "../common/api";

const InvoiceInService = {
  add: (data) => api.post("/business-access/invoice-ins",data),
  show: (id) => api.get("/business-access/invoice-ins/" + id),
  list: (data) => api.get("/business-access/invoice-ins",{
    params: data
  }),
  view: () => api.get("/business-access/view/invoice-ins"),
  update: (data) => api.put("/business-access/invoice-ins/" + data.id,data)
};
export default InvoiceInService;
