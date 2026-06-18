import React from "react";
import CommonDataTable from "../../CommonDataTable";
import Currencies from "../../Currencies";

export default function ProductAdded({ data = null, orderType = 'retail', movePage = (page) => {}, loading = false, disabled = false }) {

    const columns = [
        { label: "Name", key: "name" },
        { label: "Unit", key: "unit" },
        {
            label: 'Price',
            key: orderType === 'retail' ? 'retail_price' : "wholesale_price",
            render: (value) => {
                return <Currencies amount={value}/>
            }
        },

        {
            label: "Buy",
            key: "buy_quantity",
            render: (v) => Number(v)
        },

        {
            label: "Gift",
            key: "gift_quantity",
            render: (v) => Number(v)
        },

        {
            label: "Compensation",
            key: "compensation_quantity",
            render: (v) => Number(v)
        },

        {
            label: "Conversion",
            key: "conversion_quantity",
            render: (v) => Number(v)
        },

        {
            label: "Discount",
            key: "discount",
            render: (value) => {
                return <Currencies amount={value}/>
            }
        },

        { label: "Tax (%)", key: "tax" },
        { label: "Warehouse", key: "warehouse" }
    ];

    return (
        <div>
            <CommonDataTable
                columns={columns}
                data={data?.data}
                movePage={movePage}
                onEdit={ disabled ? null : (row) => {

                }}
                onDelete={disabled ? null :(row) => {

                }}
                loading={loading}
            />
        </div>
    );
}
