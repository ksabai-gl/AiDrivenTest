import React from 'react';
import { useI18n } from '../../../../i18n/useI18n';

export default function ApproveContent() {
    const { t } = useI18n();

    return (
        <div>
            <h2 className="h5">
                {t('Take Approved')}
            </h2>
            <p>
                {t('Please check information again before approving')}
            </p>
            <p>
                {t(
                    'You will not be able to change data after approval'
                )}
            </p>
        </div>
    );
}
