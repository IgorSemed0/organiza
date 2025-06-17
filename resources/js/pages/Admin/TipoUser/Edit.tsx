import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Edit({ item }) {
    const { data, setData, put, processing, errors } = useForm({
        vc_nome: item.vc_nome || '',
        vc_descricao: item.vc_descricao || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.tipo_users.update', item.id));
    };

    return (
        <AdminLayout title="Editar Tipo de Utilizador">
            <Head title="Editar Tipo de Utilizador" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Editar Tipo de Utilizador</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.tipo_users.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="vc_nome">Nome</Label>
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
                            <Label htmlFor="vc_descricao">Descrição</Label>
                            <Input
                                id="vc_descricao"
                                type="text"
                                value={data.vc_descricao}
                                onChange={(e) => setData('vc_descricao', e.target.value)}
                                className={errors.vc_descricao ? 'border-red-500' : ''}
                            />
                            {errors.vc_descricao && <p className="text-sm text-red-500">{errors.vc_descricao}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Atualizar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}