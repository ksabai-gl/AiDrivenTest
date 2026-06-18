import api from "../common/api";

 const ProductService = {
  add: (data) => api.post("/business-access/products",data),
  show: (id) => api.get("/business-access/products/" + id),
  list: (data) => api.get("/business-access/products",{
    params: data
  }),
  view: () => api.get("/business-access/view/products"),
  listByPurchaseId: (data) => api.get("/business-access/products",{
    params: data
  }),
  addCategory: (data) => api.post("/business-access/category-product",data),
  updateCategory: (data) => api.put("/business-access/category-product/" + data.id,data),
  listCategory: (data) => api.get("/business-access/category-product",{
    params: data
  }),
  update: (data) => api.put("/business-access/products/" + data.id,data),
  delete: (data) => api.delete("/business-access/products/"  + data.id,{
    params: data
  }),
  deleteCategory: (data) => api.delete("/business-access/category-product/" + data.id),
  viewCategory: () => api.get("/business-access/view/category-product"),
};
export default ProductService; 