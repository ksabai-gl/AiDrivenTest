import React from 'react';
import DashboardLayout from '../layouts/DashboardLayout';
import ListPurchases from '../components/Purchases/ListPurchases';
import { useSearchParams } from 'react-router-dom';
import AddProduct from '../components/Purchases/AddProduct';
import AddPurchase from '../components/Purchases/AddPurchase';
import EditPurchase from '../components/Purchases/EditPurchase';
export default function Purchases() {
    const [searchParams] = useSearchParams();
    return (
        <DashboardLayout>
            {/* {searchParams.get('id') ? <div><AddProduct/></div> : <ListPurchases/>} */}
            {searchParams.get('form') && searchParams.get('form') === 'add' 
            ? <div><AddPurchase/></div> :
            searchParams.get('form') && searchParams.get('form') === 'edit' 
            ? <div><EditPurchase/></div> : <ListPurchases/>}
        </DashboardLayout>
    );
}
