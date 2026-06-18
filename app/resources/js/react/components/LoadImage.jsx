import React, { useMemo, useState } from 'react'
export default function LoadImage({
    url = null,
    width = 150,
    height = 150,
    ref=null,
    onClick = null  
}) {
    return <img 
    ref={ref}
    onClick={onClick}
    width={width} height={height} src={url ? url : '/assets/logo-icon.png'} alt=''/>
}