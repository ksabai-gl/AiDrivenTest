import React from 'react'
import DashboardLayout from '../layouts/DashboardLayout'
import { Link, useSearchParams } from 'react-router-dom';
import { usePopup } from '../components/popups/PopupContext';
import ListOrder from '../components/Order/ListOrder';
import AddOrder from '../components/Order/AddOrder';
import EditOrder from '../components/Order/EditOrder';
export default function Order() {
  const { openPopup } = usePopup();
  const [searchParams] = useSearchParams();
  return <DashboardLayout>
    <div>
      {searchParams.get('form') && searchParams.get('form') === 'add' 
      ? <AddOrder/> : searchParams.get('form') && searchParams.get('form') === 'edit' 
      ? <EditOrder/>
      :  <ListOrder/>}

    </div>
  </DashboardLayout>
}