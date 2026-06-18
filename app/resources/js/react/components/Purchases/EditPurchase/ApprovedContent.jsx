import React from 'react';
import { useI18n } from '../../../../i18n/useI18n';

export default function ApprovedContent() {
    const { t } = useI18n();

    return (
        <div>
            <h2 className="h5 text-success">
                {t('Purchase approved')}
            </h2>
            <p>
                {t(
                    'You will not be able to change data after approval'
                )}
            </p>
        </div>
    );
}
