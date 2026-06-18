import React from 'react';
import { useI18n } from '../../../../i18n/useI18n';

export default function RequestContent() {
    const { t } = useI18n();

    return (
        <div>
            <h2 className="h5">{t('Send to request')}</h2>
            <p>
                {t(
                    'explain_approved'
                )}
            </p>
            <p>
                {t(
                    'explain_requested'
                )}
            </p>
        </div>
    );
}
