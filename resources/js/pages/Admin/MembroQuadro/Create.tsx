import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ quadros, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_quadro: '',
        it_id_user: '',
        vc_funcao: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.membro_quadros.store'));
    };

    return (
        <AdminLayout title="Criar Membro de Quadro">
            <Head title="Criar Membro de Quadro" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Membro de Quadro</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.membro_quadros.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_quadro">Quadro</Label>
                            <Select
                                value={data.it_id_quadro}
                                onValueChange={(value) => setData('it_id_quadro', value)}
                            >
                                <SelectTrigger id="it_id_quadro" className={errors.it_id_quadro ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um quadro" />
                                </SelectTrigger>
                                <SelectContent>
                                    {quadros.map((quadro) => (
                                        <SelectItem key={quadro.id} value={quadro.id.toString()}>
                                            {quadro.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_quadro && <p className="text-sm text-red-500">{errors.it_id_quadro}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user">Utilizador</Label>
                            <Select
                                value={data.it_id_user}
                                onValueChange={(value) => setData('it_id_user', value)}
                            >
                                <SelectTrigger id="it_id_user" className={errors.it_id_user ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user && <p className="text-sm text-red-500">{errors.it_id_user}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_funcao">Função</Label>
                            <Input
                                id="vc_funcao"
                                type="text"
                                value={data.vc_funcao}
                                onChange={(e) => setData('vc_funcao', e.target.value)}
                                className={errors.vc_funcao ? 'border-red-500' : ''}
                            />
                            {errors.vc_funcao && <p className="text-sm text-red-500">{errors.vc_funcao}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}