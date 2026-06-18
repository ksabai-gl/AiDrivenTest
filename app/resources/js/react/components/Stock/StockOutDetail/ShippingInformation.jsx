import React from 'react'
import BootstrapAlert from '../../BootstrapAlert'
import Currencies from '../../Currencies'
import { useI18n } from '../../../../i18n/useI18n'

export default function ShippingInformation({
    form = {
        formData: null
    }
}) {
    const { t } = useI18n();

    return (
        <div className="p-4 rounded border mt-3">
            <div className="d-flex justify-content-between mb-3">
                <h5 className="fw-semibold">
                    {t("Shipping information")}
                </h5>
            </div>
            
            <BootstrapAlert
                message={t("explain_free_shipping")}
            />

            <div className="mb-2">
                <div className="theme-title small">{t("Name")}</div>
                <div className="theme-title">{form.formData?.receiver_name || '-'}</div>
            </div>

            <div className="mb-2">
                <div className="theme-title small">{t("Email")}</div>
                <div className="theme-title">{form.formData?.receiver_email ?? '-'}</div>
            </div>

            <div className="mb-2">
                <div className="theme-title small">{t("Address")}</div>
                <div className="theme-title">{form.formData?.receiver_address ?? '-'}</div>
            </div>

            <div className="mb-2">
                <div className="theme-title small">{t("Tax code")}</div>
                <div className="theme-title">{form.formData?.tax_code ?? '-'}</div>
            </div>

            <div className="row mt-3">
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Shipping unit")}</div>
                        <div className="theme-title">{form.formData?.preferred_unit_name || '-'}</div>
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Phone")}</div>
                        <div className="theme-title">{form.formData?.phone ?? '-'}</div>
                    </div>
                </div>
            </div>

            <div className="row mt-3">
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Shipping fee actual")}</div>
                        <div className="theme-title">
                            <Currencies amount={form.formData?.shipping_fee_actual} />
                        </div>
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Shipping fee estimated")}</div>
                        <div className="theme-title">
                            <Currencies amount={form.formData?.shipping_fee_estimated} />
                        </div>
                    </div>
                </div>
            </div>

            <div className="row mt-3">
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Shipping code")}</div>
                        <div className="theme-title">{form.formData?.shipping_code ?? '-'}</div>
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="mb-2">
                        <div className="theme-title small">{t("Receiver note")}</div>
                        <div className="theme-title">{form.formData?.receiver_note ?? '-'}</div>
                    </div>
                </div>
            </div>
        </div>
    );
}