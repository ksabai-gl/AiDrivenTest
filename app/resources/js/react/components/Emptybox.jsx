import React from 'react'
import FlatIcon32 from './UI/FlatIcons/FlatIcon32'
import { useI18n } from '@/i18n/useI18n'

export default function EmptyBox({
    message = ''
}) {
    const {t} = useI18n();
    return (
        <div className="d-flex justify-content-center align-items-center w-100 h-100">
            <div className='mt-5 text-center'>
                <h4 className='h6'>{t('Empty data')}</h4>
                <i className="h1 theme-title bi bi-database-slash"></i>
                <div className='theme-title'>
                    {message ?? ''}
                </div>
            </div>
        </div>
    )
}
