import React from 'react'
export function ExtraCard({
    form = null,
    title = 'Extras'
}) {
    return form.hookRender.length >= 1 ? <div className="p-4 rounded border mt-3">
        <div className="d-flex justify-content-between mb-3">
            <h5 className="fw-semibold">
                {title}
            </h5>

        </div>
        <div className="row mt-3">
            {form.hookRender.map((item, index) => {
                return <div key={index} className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">
                            {item.label}</div>
                        <div className="theme-title">{form.formData?.[item.key]}</div>
                    </div>
                </div>
            })}
        </div>
    </div> : null

}