import { createSlice } from "@reduxjs/toolkit";

const STORAGE_KEY = "business";

function loadFromStorage() {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        return raw ? JSON.parse(raw) : null;
    } catch (e) {
        return null;
    }
}

const initialState = {
    data: loadFromStorage(),  
};

const businessInfoSlice = createSlice({
    name: "business",
    initialState,
    reducers: {
        setBusinessInfo(state, action) {
            state.data = action.payload;
            localStorage.setItem(STORAGE_KEY, JSON.stringify(action.payload));
        },
        clearBusinessInfo(state) {
            state.data = null;
            localStorage.removeItem(STORAGE_KEY);
        }
    },
});

export const { setBusinessInfo, clearBusinessInfo } = businessInfoSlice.actions;
export default businessInfoSlice.reducer;
