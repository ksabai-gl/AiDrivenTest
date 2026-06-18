import React from 'react'
export default function EntityMessage({
    entity = null 
}){
    const mess = () => {
        if(entity?.message) {
            return entity?.message
        }
        if(!entity?.type) {
            return 'unknow'
        }
        return entity?.entity_type + ' has been '+ (
            entity?.type === 'draft' || entity?.type === 'pending' 
            ? 'updated' : entity?.type
        )
    }
    return <span>
        {mess()}
    </span>
}