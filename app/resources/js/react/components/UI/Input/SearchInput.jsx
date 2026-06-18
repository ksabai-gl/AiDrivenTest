import React from 'react'
export default function SearchInput({
    className = '',
    placeholder= '',
    handleChange= (e) => {},
    value= '',
    submit = () => {

    },
    name = ''
}) {
    return <div className="input-group flex-nowrap">
        <span onClick={() => submit()} className="input-group-text cursor-default" id="addon-wrapping"><i className="bi bi-search"></i></span>
        <input name={name ?? 's'} 
        onChange={(e) => handleChange(e)} value={value} 
        type={'text'} className={"form-control " + className} 
        placeholder={placeholder} 
        aria-label={placeholder} aria-describedby="addon-wrapping"/>
            
    </div>
}