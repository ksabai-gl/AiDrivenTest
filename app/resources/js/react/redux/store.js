import { configureStore } from "@reduxjs/toolkit";
import themeReducer from "./themeSlice";
import businessReducer from './businessInfoSlice'
import notificationReducer from './NotificationSlice'
import purchasedetailReducer from './purchase/detailSlice'
import orderdetailReducer from './order/detailSlice'
import summaryDetailSliceReducer from './order/summarySlice'
import businessRoleSliceReducer from './businessRoleSlice'
export const store = configureStore({
  reducer: {
    theme: themeReducer,
    business: businessReducer,
    notify: notificationReducer,
    purchasedetail: purchasedetailReducer,
    orderdetail: orderdetailReducer,
    summarydetai: summaryDetailSliceReducer,
    businessRole: businessRoleSliceReducer
  },
});
