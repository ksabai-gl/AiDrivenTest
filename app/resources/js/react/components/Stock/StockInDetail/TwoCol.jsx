import React from 'react'
export default function TwoCol({ label, left, rightLabel, right }) {
    return (
        <div className="row mb-3">
            <div className="col-md-6">
                <div className="theme-title small">{label}</div>
                <div>{left}</div>
            </div>
            <div className="col-md-6">
                <div className="theme-title-highlight small">{rightLabel}</div>
                <div>{right}</div>
            </div>
        </div>
    );
}