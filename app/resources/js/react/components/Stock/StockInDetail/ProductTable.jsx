import React from 'react'
import CommonDataTable from '../../CommonDataTable';
export default function ProductTable({
    table = null,
    disabledActive = false
}) {

    const columns = [
        {
            label: "ID", key: "id"
        },
        { label: "Supplier", key: "supplier_name" },
        { label: "Name", key: "name" },
        { label: "Warehouse", key: "warehouse.name" },
        { label: "Category", key: "category.name" },
        { label: "Quantity", key: "quantity" },
        { label: "Sku", key: "sku" },
        { label: "Unit", key: "unit" }
    ];
    return <div>
        <CommonDataTable
            columns={columns}
            data={table?.data} 
            links={table?.links} 
            />
    </div>
}