import React from 'react'
import Currencies from '../../Currencies'
export default function TabSummaryContent({
    item = null
}) {
    return item ? <div className='row'>
        <div className='col-6 px-5'>
            <div style={{
                fontSize: 30
            }}>
                <Currencies amount={item.current} />
            </div>
        </div>
        <div className='col-6 px-5'>
            <div style={{
                fontSize: 30
            }} className={
                (item.compare >= 1 ? 'text-success ' : 'text-danger ') 
            }>
                {item.compare}%
            </div>
            <span>{item.compare_text}</span>
        </div>
    </div> : null
}