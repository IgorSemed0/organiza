import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Edit({ item, tipoUsers }) {
    const { data, setData, put, processing, errors } = useForm({
        vc_nome: item.vc_nome || '',
        email: item.email || '',
        password: '',
        password_confirmation: '',
        it_id_tipo_user: item.it_id_tipo_user?.toString() || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.users.update', item.id), {
            onSuccess: () => {
                // Optionally redirect or reset form
            },
        });
    };

    return (
        <AdminLayout title="Edit User">
            <Head title="Edit User" />
            <Card>
                <CardHeader>
                    <CardTitle>Edit User</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="vc_nome">Name</Label>
                            <Input
                                id="vc_nome"
                                type="text"
                                value={data.vc_nome}
                                onChange={(e) => setData('vc_nome', e.target.value)}
                                className={errors.vc_nome ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome && <p className="text-sm text-red-500">{errors.vc_nome}</p>}
                        </div>
                        <div>
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                className={errors.email ? 'border-red-500' : ''}
                            />
                            {errors.email && <p className="text-sm text-red-500">{errors.email}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_tipo_user">User Type</Label>
                            <Select
                                value={data.it_id_tipo_user}
                                onValueChange={(value) => setData('it_id_tipo_user', value)}
                            >
                                <SelectTrigger id="it_id_tipo_user" className={errors.it_id_tipo_user ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Select a user type" />
                                </SelectTrigger>
                                <SelectContent>
                                    {tipoUsers.map((tipoUser) => (
                                        <SelectItem key={tipoUser.id} value={tipoUser.id.toString()}>
                                            {tipoUser.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_tipo_user && <p className="text-sm text-red-500">{errors.it_id_tipo_user}</p>}
                        </div>
                        <div>
                            <Label htmlFor="password">New Password (optional)</Label>
                            <Input
                                id="password"
                                type="password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                className={errors.password ? 'border-red-500' : ''}
                            />
                            {errors.password && <p className="text-sm text-red-500">{errors.password}</p>}
                        </div>
                        <div>
                            <Label htmlFor="password_confirmation">Confirm New Password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                value={data.password_confirmation}
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                                className={errors.password_confirmation ? 'border-red-500' : ''}
                            />
                            {errors.password_confirmation && <p className="text-sm text-red-500">{errors.password_confirmation}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Update</Button>
                            <Link href={route('admin.users.index')}>
                                <Button variant="outline">Go Back</Button>
                            </Link>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}