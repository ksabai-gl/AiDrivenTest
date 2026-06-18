import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: 0,  
};

const NotificationSlice = createSlice({
    name: "notification",
    initialState,
    reducers: {
        setNotificationCount(state, action) {
            state.data = action.payload;
        },
        resetNotificationCount(state) {
            state.data = 0;
        },
        decrementNotificationCount(state){
            if(state.data === 0) {
                return;
            }
            state.data -= 1;
        },
        cleanNotificationCount(state) {
            state.data = null;
        },
    },
});

export const { setNotificationCount, resetNotificationCount,decrementNotificationCount,cleanNotificationCount } = NotificationSlice.actions;
export default NotificationSlice.reducer;
