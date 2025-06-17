import React from 'react';
import { Head } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Bar, Pie } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement } from 'chart.js';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement);

interface ChartData {
    label: string;
    count: number;
}

interface Props {
    usersByType: ChartData[];
    workplacesByVisibility: ChartData[];
    quadrosByWorkplace: ChartData[];
}

export default function Dashboard({ usersByType, workplacesByVisibility, quadrosByWorkplace }: Props) {
    const usersBarData = {
        labels: usersByType.map(item => item.label),
        datasets: [{
            label: 'Users',
            data: usersByType.map(item => item.count),
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
        }],
    };

    const workplacesPieData = {
        labels: workplacesByVisibility.map(item => item.label),
        datasets: [{
            data: workplacesByVisibility.map(item => item.count),
            backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
        }],
    };

    const quadrosBarData = {
        labels: quadrosByWorkplace.map(item => item.label),
        datasets: [{
            label: 'Quadros',
            data: quadrosByWorkplace.map(item => item.count),
            backgroundColor: 'rgba(153, 102, 255, 0.6)',
        }],
    };

    return (
        <AdminLayout title="Dashboard">
            <Head title="Dashboard" />
            <div className="space-y-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Users by Type</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Bar data={usersBarData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Workplaces by Visibility</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Pie data={workplacesPieData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Quadros by Workplace (Top 5)</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Bar data={quadrosBarData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
                    </CardContent>
                </Card>
            </div>
        </AdminLayout>
    );
}