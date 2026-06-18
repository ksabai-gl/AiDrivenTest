import api from "../common/api";

 const PurchaseTaxService = {
  add: (data) => api.post("/business-access/purchase-taxs",data)
};
export default PurchaseTaxService;