import React from 'react'
export default function InfoBox({ label, value }) {
    return (
        <div className="col-md-3">
            <div className="p-3 rounded border">
                <div className="theme-title small">{label}</div>
                <div className="theme-title-highlight fw-semibold">{value}</div>
            </div>
        </div>
    );
}