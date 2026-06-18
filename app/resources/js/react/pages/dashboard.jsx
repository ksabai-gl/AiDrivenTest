import React, { useEffect, useRef, useState } from 'react'
import DashboardLayout from '../layouts/DashboardLayout'
import DashboardSummary from '../components/Dashboard/DashboardSummary'
import BusinessChart from '../components/Dashboard/BusinessChart'
import OverviewService from '../services/OverviewService';
import { usePopup } from '../components/popups/PopupContext'
import LoadingBox from '../components/LoadingBox'
import { useI18n } from '../../i18n/useI18n';
import FlatIcon32 from '../components/UI/FlatIcons/FlatIcon32';
import { TabSummary } from '../components/Dashboard/TabSummary';
export default function Dashboard() {
    const { t } = useI18n();
    const { openPopup } = usePopup();
    const [summaryData, setSummaryData] = useState([]);
    const [businessChart, setBusinessChart] = useState([]);
    const [revenue, setRevenue] = useState([]);
    const [expense, setExpense] = useState([]);
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        setLoading(true)
        OverviewService.list()
            .then((resp) => {
                setSummaryData(resp.message.top);
                setBusinessChart(resp.message.chart)
                setRevenue(resp.message.revenue)
                setExpense(resp.message.expense)
                setLoading(false)
            })
            .catch((error) => {
                if (error.response?.data?.message) {
                    openPopup({
                        type: 'error',
                        message: error.response?.data?.message
                    })
                }
                setLoading(false)
            })

    }, []);
    return <DashboardLayout>
        <div className='dashboard-box mb-5'>
            <div>
                <div className="d-flex align-items-center mt-2">
                    <FlatIcon32 name="wave" />
                    <h3 className="ms-2 mb-0 theme-title h4">
                        {t('Welcome Back')}
                    </h3>
                </div>


                <p className='theme-title'>{t("dashboard_subtitle")}</p>
            </div>
            {loading ? <div className='mt-5'>
                <LoadingBox />
            </div> : <div>
                {summaryData.length === 0 && businessChart.length === 0 ? <div className='mt-5 pt-5'>
                    <div className='theme-title text-center'>
                        <i className="bi bi-database-fill-check h1"></i>
                        <p>{t("overview_nodata")}</p>
                    </div>
                </div> : <div>
                    <DashboardSummary summaryData={summaryData} />
                    <div className='row'>
                        <div className='col-6'>
                            <TabSummary data={revenue} title='Revenue'/>
                        </div>
                        <div className='col-6'>
                            <TabSummary data={expense} title='Expense'/>
                        </div>
                    </div>
                    <BusinessChart data={businessChart} title={t('Business chart')} />
                </div>}

            </div>}

        </div>
    </DashboardLayout>
}