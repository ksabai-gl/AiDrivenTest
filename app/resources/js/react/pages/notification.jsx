import React from 'react'
import DashboardLayout from '../layouts/DashboardLayout'
import NotificationList from '../components/NotificationList'
export default function Notification(){
    return <DashboardLayout>
        <div>
            <NotificationList/>
        </div>
    </DashboardLayout>
}