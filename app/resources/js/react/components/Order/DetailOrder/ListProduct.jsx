import React from "react";
import CommonDataTable from "../../CommonDataTable";
import Currencies from "../../Currencies";

export default function ListProduct({
    data = null,
    add = (product) => {},
    loading = false
}) {
    const columns = [
        { label: "ID", key: "id" },
        { label: "Name", key: "name" },
        { label: "Quantity", key: "quantity" },
        { label: "Category", key: "category.name" },
        {
            label: "Retail Price", key: "retail_price", render: (value) => {
                return <Currencies amount={value}/>
            }
        },
        {
            label: "Wholesale Price", key: "wholesale_price", render: (value) => {
                return <Currencies amount={value}/>
            }
        },
        {
            label: "Warehouse", key: "warehouse.name", render: (value) => {
                return value;
            }
        }
    ];
    return <div>
        <CommonDataTable
            loading={loading}
            columns={columns}
            data={data?.data}
            links={data?.links} 
            onEdit={(row) => {
                add(row)
            }}
            />
    </div>
}