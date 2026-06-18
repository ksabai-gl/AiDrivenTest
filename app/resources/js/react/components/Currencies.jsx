import React from 'react'
import { useSelector } from 'react-redux';
export default function Currencies({
    amount = 0
}) {
    const business = useSelector((state) => state.business.data);
    return <span>{
        new Intl.NumberFormat(business.currency_locale, {
            style: "currency",
            currency: business.currency,
        }).format(Number(amount))
    }</span>
}