import React from 'react';
export default function FlatIcon32({
    name = 'trial32x32',
    size = 32
}) {
    return <img alt='' src={'/assets/icons/flaticons/' + name + '.png'} width={size} height={size}/>
}