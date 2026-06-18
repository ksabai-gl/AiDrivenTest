import React from 'react'
import SearchInput from './UI/Input/SearchInput'
import { Select } from './UI/Input/Select'
import { InputForm } from './UI/Input/InputForm'
export function RenderTableSearch({
    item = null,
    search = null, 
}) {
    return <div>
        {item?.type === 'select' ? <div className=''>
            <label>{item.label}</label>
            <Select
                name={item.key}
                value={search.formData?.[item.key]}
                handleChange={search.handleChange}
                errorMessage={search.formErrors?.[item.key]}
                options={item.options} />
        </div> : item?.type === 'search' ? <div className=''>
            <label>{item.label}</label>
            <InputForm
                placeholder={item.placeholder}
                value={search.formData?.[item.key]}
                name={item.key}
                handleChange={search.handleChange}
            />
        </div> : null}
    </div>
}