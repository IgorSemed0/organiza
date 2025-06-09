import { Head } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="User Details">
            <Head title="User Details" />
            <Card>
                <CardHeader>
                    <CardTitle>User Details</CardTitle>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Name</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_nome}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Email</h3>
                            <p className="text-gray-900 dark:text-white">{item.email}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">User Type</h3>
                            <p className="text-gray-900 dark:text-white">{item.tipo_user?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Created At</h3>
                            <p className="text-gray-900 dark:text-white">{new Date(item.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}