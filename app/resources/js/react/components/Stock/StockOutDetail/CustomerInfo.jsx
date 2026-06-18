import React from 'react'
import { useI18n } from '../../../../i18n/useI18n'

export default function CustomerInfo({
    form = {
        formData: null 
    }
}) {
    const { t } = useI18n();

    return (
        <div className="p-4 rounded border mt-3">
            <div className="d-flex justify-content-between mb-3">
                <h5 className="fw-semibold">
                    {t("Customer information")}
                </h5>
            </div>
            
            <div className="mb-2">
                <div className="theme-title small">{t("Name")}</div>
                <div className="theme-title">{form.formData?.customer_name || '-'}</div>
            </div>
            
            <div className="mb-2">
                <div className="theme-title small">{t("Email")}</div>
                <div className="theme-title">{form.formData?.email || '-'}</div>
            </div>
            
            <div className="mb-2">
                <div className="theme-title small">{t("Address")}</div>
                <div className="theme-title">{form.formData?.address || '-'}</div>
            </div>
            
            <div className="row mt-3">
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Tax code")}</div>
                        <div className="theme-title">{form.formData?.tax_code ?? '-'}</div>
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Phone")}</div>
                        <div className="theme-title">{form.formData?.phone ?? '-'}</div>
                    </div>
                </div>
            </div>
        </div>
    );
}