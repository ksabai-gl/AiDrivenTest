import React, { useMemo } from 'react'
export default function EntityIconType({
    entity_type = '',
    type = ''
}) {
    const color = useMemo(() => {
        let option = '';
        switch(type) {
            case "created":
                option = "bg-success"
                break;
            case "updated":
                option = "bg-primary"
                break;
            case "deleted":
                option = "bg-danger"
                break;
            case "cancelled":
                option = "bg-danger"
                break;
            default:
                option = "bg-warning"
                break;
        }
        return option + ' notification-icon text-white';
    },[type])
    return <div>
        {entity_type === 'purchase' 
            ? <div className={color}>
                <i className="bi bi-bag"></i>
            </div> : entity_type === 'order' 
            ? <div className={color}>
                <i className="bi bi-basket2-fill"></i>
            </div> : <div className={color}>
                <i className="bi bi-receipt"></i>
            </div>}
    </div>
}