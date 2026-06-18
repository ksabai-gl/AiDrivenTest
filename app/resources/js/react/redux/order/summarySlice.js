import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: {},  
};

const summarySlice = createSlice({
    name: "summary",
    initialState,
    reducers: {
        setSummary(state, action) {
            state.data = action.payload;
        }
    },
});

export const { setSummary} = summarySlice.actions;
export default summarySlice.reducer;
