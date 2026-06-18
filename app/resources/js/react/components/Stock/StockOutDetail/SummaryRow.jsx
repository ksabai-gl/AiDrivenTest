import React from 'react'
export default function SummaryRow({ label, value, valueClass }) {
    return (
        <div className="d-flex justify-content-between theme-title mb-1">
            <span>{label}</span>
            <span className={valueClass}>{value}</span>
        </div>
    );
}