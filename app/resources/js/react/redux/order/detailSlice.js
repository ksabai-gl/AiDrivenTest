import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: {},  
};

const orderdetailSlice = createSlice({
    name: "orderdetail",
    initialState,
    reducers: {
        setOrderDetail(state, action) {
            state.data = action.payload;
        }
    },
});

export const { setOrderDetail} = orderdetailSlice.actions;
export default orderdetailSlice.reducer;
