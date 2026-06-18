import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react'
import { InputForm } from '../../UI/Input/InputForm'
import SearchSelect from '../../UI/Input/SearchSelect'
import OrderShippingService from '../../../services/OrderShippingService'
import PrimaryButton from '../../UI/Buttons/PrimaryButton';
import { usePopup } from '../../popups/PopupContext'
import { useSearchParams } from 'react-router-dom';
import ShippingService from '../../../services/ShippingService';
export default function ShippingForm({
    order = null,
    setShippingReady = (status) => { }
}) {
    const disabled = useMemo(() => {
        if(!order) {
            return true;
        }
        return order?.status === 'pending' ? false : true;
    },[order]);
    const [searchParams] = useSearchParams();
    const { openPopup } = usePopup();
    const [preferredUnit, setPreferredUnit] = useState(null);
    const [formDataShipping, setFormDataShipping] = useState(order?.shipping);
    const [formDataShippingError, setFormDataShippingError] = useState(null);
    const [shippings, setShippings] = useState([]);
    const handleChangeShipping = (e) => {
        const { name, value } = e.target;
        setFormDataShipping((prev) => ({ ...prev, [name]: value }));
    };
    const getShippings = useCallback((keywords = '',callback = null) => {
        ShippingService.list({
            page: 0,
            keywords: keywords
        })
            .then((resp) => {
                setShippings(resp.message);
                if(callback) {
                    callback();
                }
            })
            .catch((error) => {
                if (error.response.data?.message) {
                    openPopup({
                        type: 'error',
                        message: error.response.data?.message
                    })
                }
            })
    }, []);
    const submit = useCallback(() => {
        OrderShippingService.add({
            ...formDataShipping,
            preferred_unit: preferredUnit.value,
            order_id: searchParams.get('id')
        })
            .then((resp) => {
                openPopup({
                    type: 'success',
                    message: 'You has been added'
                });
                setShippingReady(true);
            })
            .catch((error) => {
                if (error.response.data?.errors) {
                    setFormDataShippingError(error.response.data?.errors)
                }
                if (error.response.data?.message) {
                    openPopup({
                        type: 'error',
                        message: error.response.data?.message
                    })
                }
            })
    }, [formDataShipping, searchParams, preferredUnit]);
    useEffect(() => {
        if (preferredUnit) {
            setShippingReady(true);
        }
    }, [preferredUnit]);
    useEffect(() => {
        if (!order || !shippings) {
            return;
        }
        setFormDataShipping(order?.shipping);
        if (order?.shipping?.preferred_unit) {
            shippings?.data?.map(item => {
                if (item.id === order?.shipping?.preferred_unit) {
                    setPreferredUnit({
                        value: item.id,
                        label: item.name
                    });
                }
            })
        }
    }, [order, shippings])
    return <div>
        <h2 className='h5'>Shipping information</h2>
        <div className='form-group'>
            <label>Receiver name</label>
            <InputForm
            disabled={disabled}
                value={formDataShipping?.receiver_name}
                handleChange={handleChangeShipping}
                name='receiver_name'
                errorMessage={formDataShippingError?.receiver_name}
                type='text'
            />
        </div>
        <div className='form-group mt-3'>
            <label>Receiver phone</label>
            <InputForm
                disabled={disabled}
                value={formDataShipping?.receiver_phone}
                handleChange={handleChangeShipping}
                name='receiver_phone'
                errorMessage={formDataShippingError?.receiver_phone}
                type='text'
            />
        </div>
        <div className='form-group mt-3'>
            <label>Receiver address</label>
            <InputForm
                disabled={disabled}
                value={formDataShipping?.receiver_address}
                handleChange={handleChangeShipping}
                name='receiver_address'
                errorMessage={formDataShippingError?.receiver_address}
                type='text'
            />
        </div>
        <div className='form-group mt-3'>
            <label>Receiver note</label>
            <InputForm
                disabled={disabled}
                value={formDataShipping?.receiver_note}
                handleChange={handleChangeShipping}
                name='receiver_note'
                errorMessage={formDataShippingError?.receiver_note}
                type='text'
            />
        </div>
        <div className='form-group mt-3'>
            <label>Preferred unit </label>
            
            <SearchSelect
                disabled={disabled}
                value={preferredUnit}
                search={getShippings}
                options={shippings?.data?.map((item) => {
                    return {
                        value: item.id,
                        label: item.name
                    }
                })}
                changeValue={(select) => setPreferredUnit(select)}
            />
        </div>
        {disabled ? null : <div className='form-group mt-3'>
            <PrimaryButton onClick={submit} label='Save' />
        </div> }
        
    </div>
}