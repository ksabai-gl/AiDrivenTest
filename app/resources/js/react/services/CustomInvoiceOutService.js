import api from "../common/api";
const CustomInvoiceOutService = {
  add: (data) => api.post("/business-access/custom-invoice-outs",data),
  show: (id) => api.get("/business-access/custom-invoice-outs/" + id),
  list: (data) => api.get("/business-access/custom-invoice-outs",{
    params: data
  }),
  view: () => api.get("/business-access/view/custom-invoice-outs"),
  update: (data) => api.put("/business-access/custom-invoice-outs/" + data.id,data),
  delete: (data) => api.delete("/business-access/custom-invoice-outs/" + data.id,{
    params: data
  })
};
export default CustomInvoiceOutService;
