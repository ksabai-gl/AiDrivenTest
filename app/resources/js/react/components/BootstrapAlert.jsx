import React from 'react'
export default function BootstrapAlert({
    message = '',
    type = 'warning',
    title = 'Noted'
}) {
    return <div className={"alert alert-"+type+" alert-dismissible fade show"}
        role="alert">
        <strong>{title}!</strong> {message}
        <button type="button" className="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
}