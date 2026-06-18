import { createSlice } from "@reduxjs/toolkit";

const STORAGE_KEY_NAV = "business_nav";
const STORAGE_KEY_ROLE = "business_role";

function loadFromStorage(key) {
    try {
        const raw = localStorage.getItem(key);
        return raw ? JSON.parse(raw) : null;
    } catch (e) {
        return null;
    }
}

const initialState = {
    nav: loadFromStorage(STORAGE_KEY_NAV),  
    role: loadFromStorage(STORAGE_KEY_ROLE),  
};

const businessRoleSlice = createSlice({
    name: "business_nav",
    initialState,
    reducers: {
        setBusinessNav(state, action) {
            state.nav = action.payload;
            localStorage.setItem(STORAGE_KEY_NAV, JSON.stringify(action.payload));
        },
        clearBusinessNav(state) {
            state.nav = null;
            localStorage.removeItem(STORAGE_KEY_NAV);
        },
        setBusinessRole(state, action) {
            state.role = action.payload;
            localStorage.setItem(STORAGE_KEY_ROLE, JSON.stringify(action.payload));
        },
        clearBusinessRole(state) {
            state.role = null;
            localStorage.removeItem(STORAGE_KEY_ROLE);
        }
    },
});

export const { setBusinessNav, clearBusinessNav, setBusinessRole, clearBusinessRole } = businessRoleSlice.actions;
export default businessRoleSlice.reducer;
