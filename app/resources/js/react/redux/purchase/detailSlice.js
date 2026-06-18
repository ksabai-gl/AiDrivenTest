import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: {},  
};

const purchasedetailSlice = createSlice({
    name: "purchasedetail",
    initialState,
    reducers: {
        setPurchaseDetail(state, action) {
            state.data = action.payload;
        }
    },
});

export const { setPurchaseDetail} = purchasedetailSlice.actions;
export default purchasedetailSlice.reducer;
