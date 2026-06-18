import React from 'react'
export default function ContentOnTable({
    value = null,
    max = 25 
}) {
    return <span>
        {value?.toString()?.length >= max ? value?.toString()?.substring(0,max) + '...' : value}
    </span>
}